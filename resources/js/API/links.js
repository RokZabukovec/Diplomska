export async function storeLinkAsync(link) {
    return await axios.post("api/links", link);
}

export async function getLinks(projectId) {
    return await axios.get("/api/links?project_id=" + projectId);
}
