import { createStore } from "vuex";
import { search } from "@/API/search";
import axios from "axios";
import { useToast } from "vue-toastification";
import { storeCommandAsync } from "../API/commands";
import useUrlParams from "../composables/useUrlParams";

const toast= useToast();
const { setUrlParams } = useUrlParams();

const searchStore = createStore({
    modules: {
        search: {
            namespaced: true,
            state: () => ({
                page: 1,
                type: "projects",
                totalPages: 1,
                projects: [],
                commands: [],
                team_members: [],
                badges: [],
                loading: true,
                query: "*",
                selected: {
                    "projectId": null,
                    "user_id": null,
                    "tag": null,
                    "member": null
                }
            }),
            mutations: {
                async storeCommand(state, form) {
                    let response = storeCommandAsync(form);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                return;
                            }
                            state.commands.unshift(response.data.data);
                            toast.success("The command has been stored.", {
                                timeout: 4000,
                            });
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
                addBadge(state, badgeObject) {
                    const index = state.badges.findIndex(badge => badge.label === badgeObject.label && badge.value === badgeObject.value);
                    if (index === -1) {
                        state.badges.push(badgeObject);
                    }
                },
                removeBadge(state, badgeObject) {
                    const index = state.badges.findIndex(badge => badge.label === badgeObject.label && badge.value === badgeObject.value);
                    if (index !== -1) {
                        state.badges.splice(index, 1);
                    }
                },
                setLoading(state, loading){
                    state.loading = loading
                },
                async storeProject(state, form) {
                    await axios
                        .post("api/projects", form)
                        .then((response) => {
                            if (response.status > 300) {
                                state.error = "There was something wrong with the request.";
                                return;
                            }
                            state.projects.unshift(response.data.data);
                            toast.success("The project has been created.", {
                                timeout: 4000,
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                            toast.error("Something went wrong when creating a project.", {
                                timeout: 4000,
                            });
                        });
                },
                async deleteProject(state, id) {
                    await axios
                        .delete("api/projects/" + id.value)
                        .then((response) => {
                            if (response.status > 300) {
                                state.error = "There was something wrong with the request.";
                                return;
                            }

                            const index = state.projects.findIndex(obj => obj.id === response.data.data.id);
                            if (index !== -1) {
                                state.projects.splice(index, 1);
                            }
                            toast.success("The project has been deleted.", {
                                timeout: 4000,
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                            toast.error("Something went wrong when creating a project.", {
                                timeout: 4000,
                            });
                        });
                },
                async deleteCommand(state, id) {
                    await axios
                        .delete("api/commands/" + id.value)
                        .then((response) => {
                            if (response.status > 300) {
                                state.error = "There was something wrong with the request.";
                                return;
                            }

                            console.log(response);
                            console.log(state.commands);

                            const index = state.commands.findIndex(obj => obj.id === response.data.id);
                            if (index !== -1) {
                                state.commands.splice(index, 1);
                            }
                            toast.success("The project has been deleted.", {
                                timeout: 4000,
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                            toast.error("Something went wrong when creating a project.", {
                                timeout: 4000,
                            });
                        });
                },
                async search(state) {
                    try {
                        state.loading = true;
                        const response = await search(state.query, state.type, state.page, state.selected);
                        switch (state.type){
                            case 'projects':
                                state.projects = response.data.hits;
                                state.totalPages = response.data.totalPages;

                                break;
                            case 'commands':
                                state.commands = response.data.hits;
                                break;
                            case 'team_members':
                                state.team_members = response.data.hits;
                                break;
                        }
                        state.totalPages = response.last_page;

                    } catch (error) {
                        console.error('Error searching:', error);
                    } finally {
                        state.loading = false;
                    }
                },
                prevPage(state)
                {
                    state.page--;
                },
                nextPage(state)
                {
                    state.page++;
                },
                setPage(state, page)
                {
                    state.page = page;
                },
                resetPage(state)
                {
                    state.page = 1;
                },
                resetSelected(state) {
                    state.selected.projectId = null;
                    state.selected.user_id = null;
                    state.selected.tag = null;
                },
                type(state, type)
                {
                    state.type = type;
                },
                setQuery(state, query) {
                    if (query === ""){
                        query = "*"
                    }
                    state.query = query;
                },
                setProjectId(state, id) {
                    state.selected.projectId = id;
                    setUrlParams({ projectId: id });
                },
                resetProjectId(state) {
                    state.selected.projectId = null;
                    setUrlParams({ projectId: null });
                },
                setUserId(state, id) {
                    state.selected.user_id = id;
                },
                resetUserId(state) {
                    state.selected.user_id = null;
                },
                setTag(state, tag) {
                    if (state.selected.tag === null) {
                        state.selected.tag = tag;

                        const { setUrlParams } = useUrlParams();
                        setUrlParams({ tag: tag });
                    }else {
                        toast.error("Only one tag is supported", {
                            timeout: 2000,
                        });
                    }
                },
                resetTag(state) {
                    state.selected.tag = null;
                },
                setSelected(state, params) {
                    state.selected = params;
                },
            },
            actions: {
                setSelected({ commit }, params){
                    commit('setSelected', params);
                    commit('search');
                },
                deleteProject({ commit }, id){
                    commit('deleteProject', id);
                },
                deleteCommand({ commit }, id){
                    commit('deleteCommand', id);
                },
                setUserId({ commit }, id){
                    commit('setUserId', id);
                    commit('search');
                },
                resetUserId({ commit }){
                    commit('resetUserId');
                    commit('search');
                },
                setTag({ commit }, tag){
                    commit('setTag', tag);
                    commit('search');
                },
                resetTag({ commit }, tag){
                    commit('resetTag');
                    commit('search');
                },
                resetPage({ commit }) {
                    commit('setPage', 1);
                    commit('search');
                },
                setPage({ commit }, page) {
                    commit('setPage', page);
                    commit('search');
                },
                nextPage({ commit }) {
                    commit('nextPage');
                    commit('search');
                },
                prevPage({ commit }) {
                    commit('prevPage');
                    commit('search');
                },
                storeProject({ commit }, data) {
                    commit('storeProject', data);
                },
                setProject({ commit }, project_id, name){
                    commit('type', 'commands');
                    commit('setProjectId', project_id);
                    commit('search');
                },
                resetProject({ commit }){
                    commit('type', 'projects');
                    commit('resetProjectId');
                    commit('search');
                },
                addBadge({ commit }, value) {
                    commit('addBadge', value);
                },
                removeBadge({ commit, dispatch }, value) {
                    commit('removeBadge', value);
                    if (value.label === 'project'){
                        dispatch('resetProject')
                    }
                    if (value.label === 'tag'){
                        dispatch('resetTag')
                    }
                    if (value.label === 'user'){
                        dispatch('resetUserId')
                    }
                },
                resetSelected({ commit }){
                    commit('resetSelected');
                },
                resetBadges({ commit }){
                    commit('resetBadges');
                    commit('resetSelected');
                }
            },
        }
    },
});

export default searchStore;
