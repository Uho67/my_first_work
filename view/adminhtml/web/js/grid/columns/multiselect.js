define(["Magento_Ui/js/grid/columns/multiselect",'uiRegistry','jquery'],function (multiselect,register,$) {


    var pages = register.get("link_grid_listing.link_grid_listing.listing_top.columns_controls");


  // console.log(pages)

register.get(function (a,b) {
    console.log(a,b);
})

    return multiselect.extend({


        updateExcluded: function (selected) {
            var excluded = this.excluded(),
                fromPage = _.difference(this.getIds(), selected);

            excluded = _.union(excluded, fromPage);
            excluded = _.difference(excluded, selected);

            this.excluded(excluded);
            // $('input[name="pages"]').val(selected).change();
            return this;
        }

    })
})