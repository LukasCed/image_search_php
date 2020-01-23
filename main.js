function appendTag() {
    var x = document.createElement("INPUT");
    x.setAttribute("name", "tag[]");
    var linebreak = document.createElement("br");

    document.getElementsByClassName('tags').item(0)
        .append(x, linebreak)
}

function appendTagForSearching() {
    var x = document.createElement("INPUT");
    x.setAttribute("name", "tag[]");
    var linebreak = document.createElement("br");

    document.getElementsByClassName('searchTags').item(0)
        .append(x, linebreak)
}
