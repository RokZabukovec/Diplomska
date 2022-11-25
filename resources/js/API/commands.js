export async function storeCommandAsync(command) {
    return await axios.post("api/commands", command);
}

export async function getCommands(projectId, page = 1) {
    return await axios.get("/api/commands?project_id=" + projectId + "&page=" + page);
}
