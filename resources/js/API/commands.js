import axios from "axios";

export async function storeCommandAsync(command) {
    return await axios.post("/api/commands", command);
}

export async function editCommandAsync(command) {
    return await axios.put("/api/commands", command);
}

export async function getCommands(project_id, page) {
    return await axios.get("/api/commands?project_id=" + project_id + "&page=" + page);
}
