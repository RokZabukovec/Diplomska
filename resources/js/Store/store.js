import {createStore} from "vuex";

// Create a new store instance.
const store = createStore({
    modules: {
        general: {
            namespaced: true,
            state: () => ({
                projects: [],
                selectedProject: null,
            }),
            mutations: {
                async getProjects(state) {
                    await axios
                        .get("/api/projects")
                        .then((response) => {
                            if (response.status > 200) {
                                console.error(response);
                                return;
                            }
                            state.projects = response.data.data;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                selectProject(state, selected) {
                    state.selectedProject = selected;
                },
            },
        },
        projects: {
            namespaced: true,
            state: () => ({}),
            mutations: {
                async storeProject(state, form) {
                    await axios
                        .post("api/projects", form)
                        .then((response) => {
                            if (response.status > 300) {
                                state.error =
                                    "There was something wrong with the request.";
                                return;
                            }
                            store.state.general.projects.unshift(
                                response.data.data
                            );
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                async deleteProject(state, project) {
                    await axios
                        .delete("api/projects/" + project.value.id)
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                            }
                            var projects = store.state.general.projects;
                            var selectedProject =
                                store.state.general.selectedProject;
                            const indexOfObject = projects.findIndex(
                                (object) => {
                                    return object.id === project.value.id;
                                }
                            );
                            store.state.general.projects.splice(
                                indexOfObject,
                                1
                            );

                            store.state.general.selectedProject =
                                projects.findIndex((object) => {
                                    return (
                                        object.id !== null &&
                                        object.id !== project.id
                                    );
                                });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
            },
        },
        commands: {
            namespaced: true,
            state: () => ({
                commands: [],
            }),
            mutations: {
                async getCommands(state) {
                    await axios
                        .get("/api/commands")
                        .then((response) => {
                            if (response.status > 200) {
                                console.error(response);
                                return;
                            }
                            state.commands = response.data.data;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                async deleteCommand(state, command) {
                    await axios
                        .delete("api/commands/" + command.value.id)
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                            }
                            var commands = store.state.general.commands;

                            const indexOfObject = commands.findIndex(
                                (object) => {
                                    return object.id === command.value.id;
                                }
                            );
                            store.state.general.commands.splice(
                                indexOfObject,
                                1
                            );
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                async storeCommand(state, form) {
                    await axios
                        .post("api/commands", form)
                        .then((response) => {
                            if (response.status > 300) {
                                state.error =
                                    "There was something wrong with the request.";
                                return;
                            }
                            store.state.general.commands.unshift(
                                response.data.data
                            );
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
            },
        },
    },
});

export default store;
