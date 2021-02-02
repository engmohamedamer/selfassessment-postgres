$.ajax({
    url:"http://api.selfassest.localhost/assessment/custom-report?id=19&user_id=28"
    ,
    method: "GET",
    "headers": {
      "Content-Type": "application/json",
      Authorization: "Bearer AznfX2FrCq3WQZ3wMDBmGIw7eVJ2LJzBGvtOQgkI"

    },
    // data: JSON.stringify({ 'invoice_id': this.CurrentInvoiceId,'invoice_return_id': this.NewInvoiceId,'invoice_register':1 }),
    // beforeSend: function () { $(".loaderCont").removeClass("hide")},
    // complete: function () { },
    success: res => {
     
     console.log(res)

    
    }
});