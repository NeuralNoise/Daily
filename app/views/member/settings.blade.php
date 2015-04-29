@extends("member/member_kalip")
@section('contentt')

<script type="text/javascript">
	function nameSurnameControl() {
		var name = document.forms["nameSurnameForm"]["name"].value;
		var surname = document.forms["nameSurnameForm"]["surname"].value;
		
		if (name=="" || surname=="") 
		{
			alert("Lütfen alanları boş bırakmayınız");
			return false;
		}
	}
	function emailPwControl() {
		var email = document.forms["emailPwForm"]["email"].value;
		var password = document.forms["emailPwForm"]["password"].value;
		var password2 = document.forms["emailPwForm"]["password2"].value;
		
		if (email=="" || password=="" || password2=="") 
		{
			alert("Lütfen alanları boş bırakmayınız");
			return false;
		}
		else
		{
			if (password != password2) {
		      alert("1. şifre ile 2. şifre aynı değil");
		      return false;
		    }
    		else{  
				if (password.length > 12 || password.length < 6) {
					alert("Şifre uzunluğu en fazla 12, en az 6 karakterden oluşmalı");
					return false;
				}
			}
		}
	}
</script>
@if (isset($update)) 
	@if ($update)
		<script type="text/javascript">
			alert("Başarıyla Güncellendi.");
		</script>
	@endif
@endif
@if (isset($message))
	<script type="text/javascript">
		alert('{{$message}}');
	</script>
@endif
<table>
	<tr>
		<td>
			<p><button id="but1">Ad / Soyad Güncelle</button></p>
			<p><button id="but2">E-mail / Şifre Değiştir</button><br></p>
			<p><a href="adminDeleteMember?memberID={{$member->memberID}}"><button id="but3">Hesabı Sil</button><br></p></a>
			<p><button id="but4">Profil Resmini Değiştir</button><br></p>
		</td>
		<td>
			<div class="operations">
				<div id="c">
					<br>
					<img align="right" src="{{$member->photo}}" width="240" height="300">								
					<br><br>
					<h1><?php echo $member->name . " " . $member->surname; ?></h1>
				</div>
			<div class="update" id="a">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
				        	 <div class="form-group">
				              </div> 
						</div>
						{{ Form::open(array('action' => 'MemberController@memberNameSurnameUpdate', 
									'onsubmit'=>'return nameSurnameControl()',
									'name' => 'nameSurnameForm'
						))}}
						<div class="form-group">
							<label for="exampleInputEmail1">Ad</label>
						{{Form::text('name', Input::old('name'), array('class' => 'form-control', 'placeholder'=>$member->name))}}
               		</div>
				 	<div class="form-group">
			               <label for="exampleInputPassword1">Soyad</label>  
			           {{Form::text('surname', Input::old('surname'), array('class' => 'form-control', 'placeholder'=>$member->surname))}}
			              </div>
			              <div class="form-group">
			                <label for="exampleInputPassword1"></label>
			               {{ Form::submit('Değiştir', array('class' => 'btn btn-primary ')) }}
			             </div>	
					</div>
				</div>
			{{ Form::close() }}
			</div>
		
		<div class="changepass" id="b">
				<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
			        	 <div class="form-group">
			              </div> 
					</div>
					{{ Form::open(array('action' => 'MemberController@memberEmailPasswordUpdate', 
								'onsubmit'=>'return emailPwControl()',
								'name' => 'emailPwForm'
					))}}
					<div class="form-group">
						<label for="exampleInputEmail1">Email</label>
						{{Form::email('email', Input::old('email'), array('class' => 'form-control', 'placeholder'=>$member->email))}}
						<!--<input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email"> -->
					</div>
				 	<div class="form-group">
			               <label for="exampleInputPassword1">Şifre</label>
			               {{Form::password('password', array('class' => 'form-control', 'placeholder'=>'******'))}}
			              </div>
			              <div class="form-group">
		                <label for="exampleInputPassword1">Şifreyi yeniden girin</label>
		                {{Form::password('password2', array('class' => 'form-control', 'placeholder'=>'******'))}}
		                <!--<input type="password" class="form-control" id="password2" placeholder="Şifre">-->
		              </div>
			              <div class="form-group">
			                <label for="exampleInputPassword1"></label>
			               {{ Form::submit('Değiştir', array('class' => 'btn btn-primary ')) }}
			             </div>	
				</div>
			</div>
			{{ Form::close() }}
			</div> <!-- end of changepass -->



			<div align="center" class="changePhoto" id="d">

				{{ Form::open(array('action' => 'MemberController@memberPhotoUpdate', 
								'files'=>true,
								'name' => 'photoForm'
				))}}

				{{ Form::label('file','File',array('id'=>'','class'=>'')) }}
				{{ Form::file('image','',array('id'=>'','class'=>'')) }}
				<br>
				{{ Form::submit('Yükle', array('class' => 'btn btn-primary'))}}
				
				{{ Form::close() }}
			</div>	<!-- end of changepass -->
			</div> <!-- end of operations -->
		</td>
	</tr>
</table>
<script type="text/javascript">
	var divObject1=document.getElementById('a');
	var divObject2=document.getElementById('b');
	var divObject3=document.getElementById('c');
	var divObject4=document.getElementById('d');
	divObject1.style.display="none";
	divObject2.style.display="none";
	divObject4.style.display="none";
	
	$(document).ready(function()
		{
			$("#but1")
			.css("color","red")
			.css("width","100px")
			.click(function(){
				divObject1.style.display = "block";
				divObject2.style.display = "none";
				divObject3.style.display = "none";
				divObject4.style.display="none";
			})
			
			$("#but2")
			.css("color","red")
			.css("width","100px")
			.click(function(){
				divObject1.style.display = "none";
				divObject2.style.display = "block";
				divObject3.style.display = "none";
				divObject4.style.display="none";
			})

			$("#but3")
			.css("color","red")
			.css("width","100px")
			.click(function(){
				if (!confirm("Hesabınızı silmek istediğinize emin misiniz?")) 
				    return false;
			})

			$("#but4")
			.css("color","red")
			.css("width","100px")
			.click(function(){
				//alert("Çalışma devam etmektedir.");
				
				divObject1.style.display = "none";
				divObject2.style.display = "none";
				divObject3.style.display = "none";
				divObject4.style.display="block";
				
			})
		})

</script>

@endsection
