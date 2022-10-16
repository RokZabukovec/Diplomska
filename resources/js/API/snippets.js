export async function storeSnippetAsync(snippet) {
    return await axios.post("api/snippets", snippet);
}

export async function getSnippets(projectId) {
    return await axios.get("/api/snippets?project_id=" + projectId);
}
