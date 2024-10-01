
<h1 class="display-1 text-center my-5">Ajouter un l'utilisateur</h1>
<div class="container w-50">

  <div class="card p-4 border-0 shadow-sm">

    <form action="?ctrl=user&action=store" method="post" >

      <div class="mb-3">
          <label for="inputLogin" class="form-label">Login</label>
          <input type="text" name="login" class="form-control" id="inputLogin">
      </div>

      <div class="mb-3">
          <label for="inputPwd" class="form-label">Mot de passe</label>
          <input type="password" name="pwd" class="form-control" id="inputPwd">
      </div>

      <button type="submit" class="btn btn-primary">Ajouter</button>

    </form>

  </div>

</div>