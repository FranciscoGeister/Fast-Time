
@extends('layouts.menu')

@section('styles')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<!-- JS file -->
{!! Html::script('vendor/autocomplete/jquery.easy-autocomplete.min.js') !!}

<!-- CSS file -->
{!! Html::style('vendor/autocomplete/easy-autocomplete.css') !!}
@endsection



@section('content')


<div id="container" class="container">
  <h2> Encuestas </h2>
  <input id="socios" class="form-control" placeholder="Ingrese socio" />
  <br>
  <div id="encuestas"></div>
  <br>
</div>
@endsection

@section('scripts')
<script>
var options = {
  data: <?php echo $members ?>,

  getValue: function(element) {
	   return element.nombre + ' ' + element.paterno + ' ' + element.materno;
  },
  list: {
    onClickEvent: function() {
      $('#encuestas').empty();
			listCreate($("#socios").getSelectedItemData().id);
		}	,
  match: {
      enabled: true
    }
  }
};

$("#socios").easyAutocomplete(options);

function getAntecedentes(id,handleData){
  $.ajax({
      type:'get',
      url:'{!!URL::to('getAntecedentes')!!}' + '/' + id,
      success:function(data){
         handleData(data);
      },
      error:function(err){
        console.log(err);
      }
  });
}
function getPatologias(id,handleData){
  $.ajax({
      type:'get',
      url:'{!!URL::to('getPatologias')!!}' + '/' + id,
      success:function(data){
         handleData(data);
      },
      error:function(err){
        console.log(err);
      }
  });
}

function getPreguntasMedicas(id,handleData){
  $.ajax({
      type:'get',
      url:'{!!URL::to('getPreguntas')!!}' + '/' + id,
      success:function(data){
         handleData(data);
      },
      error:function(err){
        console.log(err);
      }
  });
}
function getHabitos(id,handleData){
  $.ajax({
    type:'get',
    url:'{!!URL::to('getHabitos')!!}' + '/' + id,
    success:function(data){
       handleData(data);
    },
    error:function(err){
      console.log(err);
    }
  })
}


function listCreate(member_id){
    getPatologias(member_id,function(output){
      var h = document.createElement("H4");
      var list = document.createElement("ul");
      h.appendChild(document.createTextNode("Patologías"));
      document.getElementById("encuestas").appendChild(h);
      for(var patologia of output){
        var item = document.createElement("li");
        item.appendChild(document.createTextNode(patologia.nombre));
        list.appendChild(item);
      }
      document.getElementById("encuestas").appendChild(list);
    });
    getPreguntasMedicas(member_id,function(output){
      var h = document.createElement("H4");
      var list = document.createElement("dl");
      h.appendChild(document.createTextNode("Preguntas Medicas"));
      document.getElementById("encuestas").appendChild(h);
      for(var pregunta of output.preguntas){
        var item = document.createElement("dt");
        var ans = document.createElement("dd");
        for(var respuesta of output.respuestas){
          if(pregunta.id == respuesta.pregunta_id){
            item.appendChild(document.createTextNode(pregunta.pregunta));
            ans.appendChild(document.createTextNode("Respuesta: " + respuesta.respuesta));
          }
        }
        list.appendChild(item);
        list.appendChild(ans);
      }
      document.getElementById("encuestas").appendChild(list);
    });
    getAntecedentes(member_id,function(output){
      var h = document.createElement("H4");
      var list = document.createElement("ul");
      h.appendChild(document.createTextNode("Antecedentes"));
      document.getElementById("encuestas").appendChild(h);
      for(var antecedente of output){
        var item = document.createElement("li");
        item.appendChild(document.createTextNode(antecedente.nombre));
        list.appendChild(item);
      }
      document.getElementById("encuestas").appendChild(list);
    });
    getHabitos(member_id, function(output){
      var h = document.createElement("H4");
      var list = document.createElement("dl");
      h.appendChild(document.createTextNode("Habitos de Vida"));
      document.getElementById("encuestas").appendChild(h);
      for(var habito of output.vida){
        var item = document.createElement("dt");
        var ans = document.createElement("dd");
        for(var respuesta of output.respuestas){
          if(habito.id == respuesta.pregunta_id){
            item.appendChild(document.createTextNode(habito.pregunta));
            ans.appendChild(document.createTextNode("Respuesta: " + respuesta.respuesta));
          }
        }
        list.appendChild(item);
        list.appendChild(ans);
      }
      document.getElementById("encuestas").appendChild(list);

      h = document.createElement("H4");
      list = document.createElement("dl");
      h.appendChild(document.createTextNode("Habitos Laborales"));
      document.getElementById("encuestas").appendChild(h);
      for(var habito of output.laboral){
        var item = document.createElement("dt");
        var ans = document.createElement("dd");
        for(var respuesta of output.respuestas){
          if(habito.id == respuesta.pregunta_id){
            item.appendChild(document.createTextNode(habito.pregunta));
            ans.appendChild(document.createTextNode("Respuesta: " + respuesta.respuesta));
          }
        }
        list.appendChild(item);
        list.appendChild(ans);
      }
      document.getElementById("encuestas").appendChild(list);

      h = document.createElement("H4");
      list = document.createElement("dl");
      h.appendChild(document.createTextNode("Habitos No Saludables"));
      document.getElementById("encuestas").appendChild(h);
      for(var habito of output.salud){
        var item = document.createElement("dt");
        var ans = document.createElement("dd");
        for(var respuesta of output.respuestas){
          if(habito.id == respuesta.pregunta_id){
            item.appendChild(document.createTextNode(habito.pregunta));
            ans.appendChild(document.createTextNode("Respuesta: " + respuesta.respuesta));
          }
        }
        list.appendChild(item);
        list.appendChild(ans);
      }
      document.getElementById("encuestas").appendChild(list);

      h = document.createElement("H4");
      list = document.createElement("dl");
      h.appendChild(document.createTextNode("Habitos Nutricionales"));
      document.getElementById("encuestas").appendChild(h);
      for(var habito of output.nutricion){
        var item = document.createElement("dt");
        var ans = document.createElement("dd");
        for(var respuesta of output.respuestas){
          if(habito.id == respuesta.pregunta_id){
            item.appendChild(document.createTextNode(habito.pregunta));
            ans.appendChild(document.createTextNode("Respuesta: " + respuesta.respuesta));
          }
        }
        list.appendChild(item);
        list.appendChild(ans);
      }
      document.getElementById("encuestas").appendChild(list);
    });


}
</script>
@endsection
