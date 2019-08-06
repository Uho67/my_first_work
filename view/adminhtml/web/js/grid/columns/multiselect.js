define(["Magento_Ui/js/grid/columns/multiselect",'uiRegistry','jquery'],function (multiselect,register,$) {
    var pages = register.get('link_form.link_form.general.pages');


    return multiselect.extend({
        onSelectedChange: function (selected) {
            this.updateExcluded(selected)
                .countSelected()
                .updateState();
            $('input[name="pages"]').val(selected).change();
        },
        onRowsChange: function () {
            var newSelections;

            if (this.excludeMode()) {
                newSelections = _.union(this.getIds(true), this.selected());
                this.selected(newSelections);
            }else{
                if (pages) {
                    this.selected( pages.initialValue.split(','));
                }
            }
        }

    })
})