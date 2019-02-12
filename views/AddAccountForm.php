<!DOCTYPE html>
<html lang="fr" xml:lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>Create account :: Bank</title>
  </head>
  <body>
    <h1>Bank</h1>
    <h2>Create account</h2>
    <form method="post" action="index.php?page=user_add">
      <label for="startingAmount">Starting amount</label><br>
      <input type="number" name="startingAmount" min="0" step="0.1"><br>
      <input type="submit" value="Create account">
    </form>
  </body>
</html>
