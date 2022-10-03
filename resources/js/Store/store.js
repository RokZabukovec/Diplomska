import { createStore } from "vuex";
import { getCommands, storeCommandAsync } from "../API/commands.js";
import { getLinks, storeLinkAsync } from "../API/links";
import { getSnippets, storeSnippetAsync } from "../API/snippets";
import { getPages, storePageAsync } from "../API/pages";

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
                        .delete("api/projects/" + project.id)
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                            }
                            var projects = store.state.general.projects;
                            var selectedProject =
                                store.state.general.selectedProject;
                            const indexOfObject = projects.findIndex(
                                (object) => {
                                    return object.id === project.id;
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
                async getCommands(state, projectId) {
                    let commands = getCommands(projectId.value);
                    await commands
                        .then((response) => {
                            console.log(response);
                            store.state.commands.commands = response.data.data;
                        })
                        .catch((e) => {
                            console.log(e);
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
                    let response = storeCommandAsync(form);
                    console.log(response);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            store.state.commands.commands.push(
                                response.data.data
                            );
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
            },
        },
        pages: {
            namespaced: true,
            state: () => ({
                pages: [],
            }),
            mutations: {
                async getPages(state, projectId) {
                    let pages = getPages(projectId.value);
                    await pages
                        .then((response) => {
                            console.log(response);
                            store.state.pages.pages = response.data.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },

                async storePage(state, form) {
                    let response = storePageAsync(form);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            state.pages.push(response.data.data);
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
            },
        },
        links: {
            namespaced: true,
            state: () => ({
                links: [],
            }),
            mutations: {
                async getLinks(state, projectId) {
                    let links = getLinks(projectId.value);
                    await links
                        .then((response) => {
                            store.state.links.links = response.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },

                async storeLink(state, form) {
                    let response = storeLinkAsync(form);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            store.state.links.links.push(response);
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
            },
        },
        snippets: {
            namespaced: true,
            state: () => ({
                snippets: [],
            }),
            mutations: {
                async getSnippets(state, projectId) {
                    let snippets = getSnippets(projectId.value);
                    await snippets
                        .then((response) => {
                            console.log(response);
                            store.state.snippets.snippets = response.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },

                async storeSnippet(state, form) {
                    let response = storeSnippetAsync(form);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            state.snippets.push(response);
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
            },
        },
    },
});

export default store;
