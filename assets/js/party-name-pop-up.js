function openPopUp(){

    return vex.dialog.open({
      message: 'Enter Account Name:', showCloseButton: true,
         className: 'vex-theme-os',
      input: [
          '<input name="account_name" type="text" placeholder="Enter Account Name" required />',
      ].join(''),
      buttons: [
          jQuery.extend({}, vex.dialog.buttons.YES, { text: 'Add' }),
          jQuery.extend({}, vex.dialog.buttons.NO, { text: 'Back' })
      ],
      callback: function (data) {
          if (!data) {
              console.log('Cancelled')
          } else {

              $.ajax({
                method: "POST",
                url: getBaseUrl()+'/api/accounts/add',
                data: { name: data.account_name, gate_entry:1}
              })
                .done(function( msg ) {
                  if(msg.STATUS == "SUCCESS"){
                    window.GATE_ENTRY.accounts.push(msg.RESPONSE);
                    window.GATE_ENTRY.accountId = msg.RESPONSE.id;
                  }
                  // location.href = getBaseUrl()+'/gate_pass/index';
              });
          }
      }
  });   

}
