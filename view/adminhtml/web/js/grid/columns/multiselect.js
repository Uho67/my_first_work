define(["Magento_Ui/js/grid/columns/multiselect",'uiRegistry','jquery'],function (multiselect,register,$) {
  
    var pages = register.get('link_form.link_form.general.pages');

    return multiselect.extend({

        defaults: {
            headerTmpl: 'ui/grid/columns/multiselect',
            controlVisibility:false,
            sortable: false,
            draggable: false,
            menuVisible: false,
            excludeMode: false,
            allSelected: false,
            indetermine: false,
            preserveSelectionsOnFilter: false,
            disabled: [],
            selected: [],
            excluded: [],
            fieldClass: {
                'data-grid-checkbox-cell': true
            }},
        hasFieldAction: function () {

            var id = document.getElementById('check2');
            console.log(id);
            return false;
        },

        updateExcluded: function (selected) {
            var excluded = this.excluded(),
                fromPage = _.difference(this.getIds(), selected);

            excluded = _.union(excluded, fromPage);
            excluded = _.difference(excluded, selected);

            this.excluded(excluded);
            $('input[name="pages"]').val(selected).change();

            return this;
        },
        onRowsChange: function () {
            var newSelections;

            if (this.excludeMode()) {
                newSelections = _.union(this.getIds(true), this.selected());

                this.selected(newSelections);
            }
            // this.selected(newSelections = [5,7]);
        }

        // ,
        //
        // selectPage: function () {
        //     var selected = _.union(this.selected(), this.getIds());
        //     $('input[name="pages"]').val(selected).change();
        //
        //     selected = _.difference(selected, this.disabled());
        //
        //     this.selected(selected);
        //
        //     return this;
        // }

    })
})