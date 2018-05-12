<template>
  <vue-autosuggest ref="refSuggest"
    :suggestions="optionsFiltered" :on-selected="onSelected" :input-props="inputProps"
    />
</template>

<script>
import { VueAutosuggest } from 'vue-autosuggest'
export default {
  name: 'AutoSuggest',
  components: {
    VueAutosuggest
  },
  data () {
    return {
      optionsFiltered: []
    }
  },
  computed: {
    inputProps () {
      return {
        id: 'autosuggest__input',
        onInputChange: this.onInputChange,
        placeholder: this.placeholder
      }
    }
  },
  props: ['placeholder', 'options', 'value'],
  mounted () {
  },
  watch: {
    value: function (value) {
      this.$refs.refSuggest.searchInput = value
    }
  },
  methods: {
    onSelected (selectedOptions) {
      let selected = selectedOptions ? selectedOptions.item : undefined
      this.$emit('input', selected)
    },
    onInputChange (text) {
      if (text === '' || text === undefined || text === null) {
        this.$emit('input', undefined)
        return
      }
      this.$emit('input', text)
      const filteredData = this.options.filter(item => {
        return item.toLowerCase().indexOf(text.toLowerCase()) > -1
      })
      this.optionsFiltered = [{ data: filteredData }]
    }
  }
}
</script>

<style>
  .autosuggest__results-container {
    position: relative;
    width: 100%;
  }
  
  .autosuggest__results {
    font-weight: 300;
    margin: 0;
    position: absolute;
    z-index: 10000001;
    width: 100%;
    border: 1px solid #e0e0e0;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    background: white;
    padding: 0px;
    overflow: scroll;
    max-height: 200px;
  }
  
  .autosuggest__results ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
  }
  
  .autosuggest__results .autosuggest__results_item {
    cursor: pointer;
    padding: 15px;
  }
  
  #autosuggest ul:nth-child(1) > .autosuggest__results_title {
    border-top: none;
  }
  
  .autosuggest__results .autosuggest__results_title {
    color: gray;
    font-size: 11px;
    margin-left: 0;
    padding: 15px 13px 5px;
    border-top: 1px solid lightgray;
  }
  
  .autosuggest__results .autosuggest__results_item:active,
  .autosuggest__results .autosuggest__results_item:hover,
  .autosuggest__results .autosuggest__results_item:focus,
  .autosuggest__results .autosuggest__results_item.autosuggest__results_item-highlighted {
    background-color: #ddd;
  }
</style>
