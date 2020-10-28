$(document).ready(() => {
  $(".navShowHide").on("click", () => {
    const mainContent = $("#mainContent");
    const sidenav = $("#sidenav");

    if (mainContent.hasClass("leftPadding")) {
      sidenav.hide();
    } else {
      sidenav.show();
    }

    mainContent.toggleClass("leftPadding");
  });
});