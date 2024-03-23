import { createStore } from "vuex";
import { search } from "@/API/search";

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
                // Mutation to add a string to the array
                addBadge(state, value) {
                    const index = state.badges.indexOf(value);
                    if (index === -1) {
                        state.badges.push(value);
                    }
                },
                // Mutation to remove a string from the array
                removeBadge(state, value) {
                    const index = state.badges.indexOf(value);
                    if (index !== -1) {
                        state.badges.splice(index, 1);
                    }
                },
                setLoading(state, loading){
                    state.loading = loading
                },
                async search(state) {
                    try {
                        state.loading = true;
                        const response = await search(state.query, state.type, state.page, state.selected);
                        switch (state.type){
                            case 'projects':
                                state.projects = response.data;
                                break;
                            case 'commands':
                                console.log("response", response);
                                console.log("commands", response.commands.data);

                                state.commands = response.commands.data;
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
                removeBadge({ commit }, value) {
                    commit('removeBadge', value);
                }
            },
        }
    },
});

export default searchStore;
