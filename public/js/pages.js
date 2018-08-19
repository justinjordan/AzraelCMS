var PagesController = function() {};

PagesController.prototype.setupVue = function() {
    var _this = this;

    /** Init Vue */
    this.vue = new Vue({
        el: document.querySelector('main'),
        data: {
            pages: null
        }
    });

    /** Fetch Pages */
    fetch('/admin/pages/api/getpages')
        .then(function(response) {
            if (response.status !== 200) {
                console.error("Couldn't fetch pages!");
            }

            response.json().then(function(res) {
                if (!res.success) {
                    return console.error(res.error);
                }

                if (res.data.pages) {
                    _this.vue.pages = res.data.pages;
                }
            });
        });
};

var pages = new PagesController();

pages.setupVue();