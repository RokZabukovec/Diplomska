import { createStore } from 'vuex'

// Create a new store instance.
const store = createStore({
    modules: {
        general: {
            namespaced: true,
            state: () => ({
                projects: []
            }),
            mutations: {
                async getProjects(state){
                    await axios.get('/api/projects')
                        .then(response => {
                            if (response.status > 200) {
                                console.error(response);
                                return;
                            }
                            state.projects = response.data.data;
                        })
                        .catch(error => {
                            console.error(error);
                        });
                },
            },
        }
    }
});

export default store;
