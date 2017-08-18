<template>
  <select class="form-control select2" style="width: 100%;">
    <option></option>
  </select>
</template>

<script>
export default {
  name: 'Select2',
  props: ['placeholder', 'options', 'value'],
  mounted () {
    $(this.$el).select2({
      placeholder: this.placeholder,
      data: this.options,
      tags: true,
      tokenSeparators: ['|']
    })
    // .val(this.value)
    .trigger('change')
    .on('change', () => {
      this.$emit('input', $(this.$el).val())
    })
  },
  watch: {
    value: function (value) {
      $(this.$el).val(value).trigger('change')
    },
    options: function (options) {
      $(this.$el).select2({
        placeholder: this.placeholder,
        data: options,
        tags: true,
        tokenSeparators: ['|']
      })
    }
  },
  beforeDestroy () {
    $(this.$el).off().select2('destroy')
  }
}
</script>

<style>
.select2-container .select2-selection--single {
  height: 34px;
}
</style>
