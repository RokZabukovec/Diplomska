import axios from "axios";

export async function search(query = "*" , model = "projects", page = 1) {
    const encodedQuery = encodeURIComponent(query);
    const encodedModel = encodeURIComponent(model);
    const url = `/api/search?q=${encodedQuery}&model=${encodedModel}&page=${page}`;

    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        // Handle errors here
        console.error('Error searching:', error);
        throw error;
    }
}
