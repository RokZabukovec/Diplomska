import axios from "axios";

export async function search(query = "*" , model = "projects", page = 1, selected) {
    const encodedQuery = encodeURIComponent(query);
    const encodedModel = encodeURIComponent(model);
    let url = `/api/search?q=${encodedQuery}&model=${encodedModel}&page=${page}`;

    if (selected.project_id != null && model === 'commands') {
        const encodedProjectId = encodeURIComponent(selected.project_id);

        url = `${url}?project_id=${encodedProjectId}`;
    }
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        // Handle errors here
        console.error('Error searching:', error);
        throw error;
    }
}
