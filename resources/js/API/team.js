export async function getMembers() {
    return await axios.get("/api/user/personalteam/members");
}
