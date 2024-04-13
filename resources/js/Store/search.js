import { createStore } from "vuex";
import { search } from "@/API/search";
import axios from "axios";
import { useToast } from "vue-toastification";

const toast= useToast();

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
                    "tag": null
                }
            }),
            mutations: {
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
                            state.projects.unshift(response.data);
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
                async search(state) {
                    try {
                        state.loading = true;
                        const response = await search(state.query, state.type, state.page, state.selected);
                        switch (state.type){
                            case 'projects':
                                console.log(response);
                                state.projects.push(...response.hits);

                                break;
                            case 'commands':
                                state.commands = response.data;
                                break;
                            case 'team_members':
                                console.log("team", response.data);

                                state.team_members = response.data;
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
                },
                resetProjectId(state) {
                    state.selected.projectId = null;
                },
                setUserId(state, id) {
                    state.selected.user_id = id;
                },
                resetUserId(state) {
                    state.selected.user_id = null;
                },
                setTag(state, tag) {
                    state.selected.tag = tag;
                },
                resetTag(state) {
                    state.selected.tag = null;
                },
            },
            actions: {
                incrementPage({ commit }) {
                    commit('nextPage');
                    commit('search');
                },
                storeProject({ commit }, data) {
                    commit('storeProject', data);
                },
                setProject({ commit }, project_id){
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
