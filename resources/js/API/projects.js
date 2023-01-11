import axios from "axios";
export async function editProjectAsync(project) {
    console.log("API: ", project);
    console.log("API ID: ", project.id);
    return await axios.put("/api/projects/" + project.id, project);
}
