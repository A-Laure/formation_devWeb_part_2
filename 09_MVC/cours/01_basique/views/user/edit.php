<h1 class="display-1 text-center my-5">Modification</h1>
<div class="container w-50">

  <div class="card p-4 border-0 shadow-sm">

    <form action="?ctrl=user&action=update&id=<?= $user->getId() ?>" method="post" >

      <div class="mb-3">
          <label for="inputLogin" class="form-label">Login</label>
          <input type="text" name="login" class="form-control" id="inputLogin" value="<?= $user->getLogin() ?>">
      </div>

      <button type="submit" class="btn btn-primary">Modifier</button>

    </form>

  </div>

</div>