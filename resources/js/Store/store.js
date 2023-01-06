import { createStore } from "vuex";
import { getCommands, storeCommandAsync, editCommandAsync } from "../API/commands.js";
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
                loadingProjects: false,
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
                    store.state.general.loadingProjects = true;
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
                        })
                        .finally(() => {
                            store.state.general.loadingProjects = false;
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
                        .delete("/api/projects/" + project.id)
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
                    store.state.general.loading = true;
                    let commands = getCommands(project, page);
                    await commands
                        .then((response) => {
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
                async editCommand(state, form) {
                    let response = editCommandAsync(form);
                    console.log(response);
                    response
                        .then((response) => {
                            if (response.status > 300) {
                                console.log(response);
                                return;
                            }
                            var foundIndex = store.state.commands.commands.findIndex((x) => x.id == response.data.data.id);
                            store.state.commands.commands[foundIndex] = response.data.data;
                        })
                        .catch((e) => {
                            console.log(e);
                        });
                },
                async setCommands(state, response) {
                    store.state.commands.data = response;
                    store.state.commands.commands = response.data.data;
                    store.state.commands.pagination = response.data;
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
