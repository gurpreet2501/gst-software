jQuery(function($){

  window.BILLING_FORM = new Vue({
  el: '#billing_form',
  data: {
   tile_count:6,
   gst_rates:[1,2]
  },
  computed: {
    tiles: function(){
        return v('add_tiles');
      }
  },
  methods:{
    check_current_gst_value:function(){
      console.log(gst_rates);
    }
  }
})
});