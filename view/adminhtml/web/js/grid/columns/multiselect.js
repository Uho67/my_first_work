define(["Magento_Ui/js/grid/columns/multiselect",'uiRegistry','jquery'],function (multiselect,register,$) {
  
    var pages = register.get('link_form.link_form.general.pages');

    return multiselect.extend({

        updateExcluded: function (selected) {
            var excluded = this.excluded(),
                fromPage = _.difference(this.getIds(), selected);

            excluded = _.union(excluded, fromPage);
            excluded = _.difference(excluded, selected);

            this.excluded(excluded);
            $('input[name="pages"]').val(selected).change();
            console.log('2');
            return this;
        }

    })
})