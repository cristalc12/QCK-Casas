//sidebar functionality 

var sidebarOpen = false;
var sidebar = document.getElementById('sidebar');

function openSidebar () {
    if (!sidebarOpen) {
        sidebar.classList.add("sidebar-responsive");
        sidebarOpen = true;
    }
}

function closedSideBar () {
    if(sidebarOpen) {
        sidebar.classList.remove("sidebar-responsive"); 
        sidebarOpen = false;
    }
}

function goBack() {
    window.history.back();
}
