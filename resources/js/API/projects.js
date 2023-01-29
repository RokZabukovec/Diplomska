import axios from "axios";

export async function editProjectAsync(project) {
    return await axios.put("/api/projects/" + project.id, project);
}
