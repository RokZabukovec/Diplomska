export async function storePageAsync(page) {
    return await axios.post("api/pages", page);
}

export async function getPages(projectId) {
    return await axios.get("/api/pages?project_id=" + projectId);
}
