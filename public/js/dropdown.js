$("#sucursal").change(event => {
	$.get(`getProductos/${event.target.value}`, function(res, sta){
		$("#producto").empty();
		res.forEach(element => {
			$("#producto").append(`<option value=${element.id}> ${element.name} </option>`);
		});
	});
});