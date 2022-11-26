import { createStore } from "vuex";
import { getCommands, storeCommandAsync } from "../API/commands.js";
import { getLinks, storeLinkAsync } from "../API/links";
import { getSnippets, storeSnippetAsync } from "../API/snippets";
import { getPages, storePageAsync } from "../API/pages";
import { getMembers } from "../API/team.js";

// Create a new store instance.
const store = createStore({
    modules: {
        general: {
            namespaced: true,
            state: () => ({
                user: {},
                projects: [],
                pined: [],
                selectedProject: null,
                teams: [],
                loading: false,
            }),
            mutations: {
                async switchTeam(state, team) {
                    await axios
                        .put("/api/user/teams/switch?team_id=" + team)
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            state.teams = response.data;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                async getTeams(state) {
                    await axios
                        .get("/api/user/teams")
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            state.teams = response.data;
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                async getProjects(state) {
                    await axios
                        .get("/api/user/teams/projects")
                        .then((response) => {
                            if (response.status > 300) {
                                console.error(response);
                                return;
                            }
                            state.projects = response.data;

                            state.projects.map((project) => {
                                let splitName = project.name.split(" ");

                                if (splitName.length === 1) {
                                    project.initials = splitName[0].slice(0, 2);
                                }

                                if (splitName.length >= 2) {
                                    project.initials = splitName[0].slice(0, 1) + splitName[1].slice(0, 1);
                                }
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                selectProject(state, selected) {
                    state.selectedProject = selected;
                },
                setUser(state, user) {
                    state.user = user;
                },
            },
        },
        projects: {
            namespaced: true,
            state: () => ({}),
            mutations: {
                async storeProject(state, form) {
                    store.state.general.loading = true;
                    await axios
                        .post("api/projects", form)
                        .then((response) => {
                            if (response.status > 300) {
                                store.state.general.loading = false;
                                state.error = "There was something wrong with the request.";
                                return;
                            }
                            let user = store.state.general.user;
                            store.state.general.projects.push(response.data.data);
                        })
                        .catch((error) => {
                            console.error(error);
                        })
                        .finally(() => {
                            store.state.general.loading = false;
                        });
                },
                async deleteProject(state, project) {
                    await axios
                        .delete("api/projects/" + project.id)
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            var projects = store.state.general.projects;
                            let user = store.state.general.user;
                            store.state.general.projects.map((stored) => {
                                if (stored.id === project.id) {
                                    let index = projects.findIndex((storedProject) => storedProject.id == project.id);
                                    store.state.general.projects.splice(index, 1);
                                }
                            });
                        })
                        .catch((error) => {
                            console.error(error);
                        });
                },
                pinProject(state, project) {
                    let projects = store.state.general.projects;
                    axios
                        .put(`api/projects/${project.id}/pin`)
                        .then((response) => {
                            let index = projects.map((project) => project.id).indexOf(project);
                            project.pined = !project.pined;
                            if (!project.pined) {
                                project.pined = false;
                                store.state.general.pined.splice(index, 1);
                            } else {
                                project.pined = true;
                                store.state.general.pined.push(project);
                            }

                            store.state.general.projects[index] = project;
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                },
            },
        },
        commands: {
            namespaced: true,
            state: () => ({
                commands: [],
                pagination: {},
                data: {},
                filters: {
                    people: null,
                    query: "",
                    tag: null,
                },
            }),
            mutations: {
                async getCommands(state, { project, page }) {
                    console.log("STATE: ", state);
                    console.log("PAGE IN STORE: ", page);
                    store.state.general.loading = true;
                    let commands = getCommands(project, page);
                    await commands
                        .then((response) => {
                            console.log(response);
                            store.state.commands.data = response;
                            store.state.commands.commands = response.data.data;
                            store.state.commands.pagination = response.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                        .finally(() => {
                            store.state.general.loading = false;
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

                            const indexOfObject = commands.findIndex((object) => {
                                return object.id === command.value.id;
                            });
                            store.state.general.commands.splice(indexOfObject, 1);
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
                            store.state.commands.commands.push(response.data.data);
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
                    store.state.general.loading = true;
                    let pages = getPages(projectId.value);
                    await pages
                        .then((response) => {
                            console.log(response);
                            store.state.pages.pages = response.data.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                        .finally(() => {
                            store.state.general.loading = false;
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
                    store.state.general.loading = true;
                    let links = getLinks(projectId.value);
                    await links
                        .then((response) => {
                            store.state.links.links = response.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        })
                        .finally(() => {
                            store.state.general.loading = false;
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
                            store.state.links.links.push(response.data.data);
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
        teams: {
            namespaced: true,
            state: () => ({
                members: [],
            }),
            mutations: {
                async getMembers() {
                    let members = getMembers();
                    await members
                        .then((response) => {
                            store.state.teams.members = response.data;
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
