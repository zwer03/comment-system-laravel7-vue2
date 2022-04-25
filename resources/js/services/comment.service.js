export const commentService = {
    store,
    list,
}

function store(comment) {
    return axios.post("comment", comment)
}

function list() {
    return axios.get("comment")
}