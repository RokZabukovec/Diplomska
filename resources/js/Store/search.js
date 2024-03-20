import { createStore } from "vuex";
import { search } from "@/API/search";

const searchStore = createStore({
    modules: {
        search: {
            namespaced: true,
            state: () => ({
                page: 1,
                type: "projects",
                projects: [],
                selectedProject: null,
                loading: false,
                query: "*"
            }),
            mutations: {
                async search(state) {
                    try {
                        state.loading = true;
                        const response = await search(state.query, state.type, state.page);
                        state.projects = response.data;
                    } catch (error) {
                        console.error('Error searching:', error);
                    } finally {
                        state.loading = false;
                    }
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
            },
            actions: {

            },
        }
    },
});

export default searchStore;
