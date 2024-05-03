import axios from "axios";

export async function search(query = "*", model = "projects", page = 1, selected = {}) {
    // Input validation
    if (typeof query !== 'string' || typeof model !== 'string' || typeof page !== 'number') {
        throw new Error('Invalid input type');
    }

    // Encoding query parameters
    const encodedQuery = encodeURIComponent(query);
    const encodedModel = encodeURIComponent(model);

    // Constructing URL
    let url = `/api/search?q=${encodedQuery}&model=${encodedModel}&page=${page}`;

    // Handling selected project ID
    if (selected.projectId != null) {
        const encodedProjectId = encodeURIComponent(selected.projectId);
        url += `&project_id=${encodedProjectId}`;
    }

    if (selected.tag != null) {
        const encodedTag = encodeURIComponent(selected.tag);
        url += `&tag=${encodedTag}`;
    }

    if (selected.user_id != null) {
        const encodedUserId = encodeURIComponent(selected.user_id);
        url += `&user_id=${encodedUserId}`;
    }

    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        // Error handling
        console.error('Error searching:', error.response ? error.response.data : error.message);
        throw new Error('Failed to search'); // or handle the error as appropriate for your application
    }
}

