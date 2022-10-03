export async function storeCommandAsync(command) {
    console.log("STORE COMMAND", command);
    return await axios.post("api/commands", command);
}

export async function getCommands(projectId) {
    return await axios.get("/api/commands?project_id=" + projectId);
}
