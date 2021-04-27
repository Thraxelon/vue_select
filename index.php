<?php
include_once 'class/dbh.inc.php';
include_once 'class/variables.inc.php';
include_once 'class/phhdate.inc.php';

//to check debug $_POST
?>
<!DOCTYPE html>
<html lang="en">

    <?php include "header.php"; ?>

    <body>

        <?php #include"navmenu.php";     ?>

        <div class="container">

            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-md">
                        <h1>Test Vue Searchable Select</h1>
                    </div>
                </div>
                <br>
                <br>
                <div id="mainArea">
                    {{test}}
                    <!--<Dropdown v-bind:options="[{aid:1,co_name:'option1'},{aid:2,co_name:'option2'},{aid:3,co_name:'option3'}]" ></Dropdown>-->
                    <Dropdown v-bind:options="customerList" v-on:filter='' v-on:selected='customerSelected'></Dropdown>
                    <div>
                        Selected :<br>
                        Cid = {{cid}}<br>
                        Customer = {{co_name}}<br>
                    </div>
                </div>

            </div>

        </div>
        <script>
//            Vue.component('dropdown', {
//                props: {
//                    name: {
//                        type: String,
//                        required: false,
//                        default: 'Dropdown',
//                        note: 'Input name'
//                    },
//                    options: {
//                        type: Array,
//                        required: true,
//                        default: [],
//                        note: 'Options of dropdown. An array of options with id and name',
//                    },
//                    placeholder: {
//                        type: String,
//                        required: false,
//                        default: 'Please select an option',
//                        note: 'Placeholder of dropdown'
//                    },
//                    disabled: {
//                        type: Boolean,
//                        required: false,
//                        default: false,
//                        note: 'Disable the dropdown'
//                    },
//                    maxItem: {
//                        type: Number,
//                        required: false,
//                        default: 6,
//                        note: 'Max items showing'
//                    }
//                },
//                data() {
//                    return {
//                        selected: {},
//                        optionsShown: false,
//                        searchFilter: ''
//                    }
//                },
//                created() {
//                    this.$emit('selected', this.selected);
//                },
//                computed: {
//                    filteredOptions() {
//                        const filtered = [];
//                        const regOption = new RegExp(this.searchFilter, 'ig');
//                        for (const option of this.options) {
//                            if (this.searchFilter.length < 1 || option.name.match(regOption)) {
//                                if (filtered.length < this.maxItem)
//                                    filtered.push(option);
//                            }
//                        }
//                        return filtered;
//                    }
//                },
//                methods: {
//                    selectOption(option) {
//                        this.selected = option;
//                        this.optionsShown = false;
//                        this.searchFilter = this.selected.name;
//                        this.$emit('selected', this.selected);
//                    },
//                    showOptions() {
//                        if (!this.disabled) {
//                            this.searchFilter = '';
//                            this.optionsShown = true;
//                        }
//                    },
//                    exit() {
//                        if (!this.selected.aid) {
//                            this.selected = {};
//                            this.searchFilter = '';
//                        } else {
//                            this.searchFilter = this.selected.name;
//                        }
//                        this.$emit('selected', this.selected);
//                        this.optionsShown = false;
//                    },
//                    // Selecting when pressing Enter
//                    keyMonitor: function (event) {
//                        if (event.key === "Enter" && this.filteredOptions[0])
//                            this.selectOption(this.filteredOptions[0]);
//                    }
//                },
//                watch: {
//                    searchFilter() {
//                        if (this.filteredOptions.length === 0) {
//                            this.selected = {};
//                        } else {
//                            this.selected = this.filteredOptions[0];
//                        }
//                        this.$emit('filter', this.searchFilter);
//                    }
//                },
//                template: '<div class="dropdown" v-if="options"> <input class="dropdown-input" :name="name" @focus="showOptions()" @blur="exit()"  @keyup="keyMonitor" v-model="searchFilter" :disabled="disabled" :placeholder="placeholder" />  <div class="dropdown-content" v-show="optionsShown">  <div class="dropdown-item" @mousedown="selectOption(option)"  v-for="(option, index) in filteredOptions" :key="index">{{ option.name || option.aid || ' - ' }}</div></div></div>'
//            });
            var searchVue = new Vue({
                el: '#mainArea',
                data: {
                    phpajaxresponsefile: 'test.axios.php',
                    test: 'Select Customer',
                    customerList: [],
                    cid: '',
                    co_name: '',
                },
                watch: {

                },
                methods: {
                    getSearchCustomer: function (val) {
                        axios.post(this.phpajaxresponsefile, {
                            src_co_name: val,
                            action: 'getCustomer'
                        }).then(function (resp) {
                            searchVue.customerList = resp.data;
                        })
                    },
                    customerSelected: function (val) {
                        console.log('selected ' + val.id);
                        this.cid = val.id;
                        this.co_name = val.name;
                    }
                },
                mounted: function () {
                    this.getSearchCustomer('');
                }
            });
        </script>
        <?php include"footer.php" ?>
    </body>
</html>


