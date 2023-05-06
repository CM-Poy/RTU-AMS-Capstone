<?php 
require('../includes/config.php'); ?>
<style><?php include 'style.css'; ?></style>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body onload="createClassList()" style="background-color: beige">
<?php
  $stmt = $conn->prepare('SELECT * FROM sections.CBET-23-102P');
  $stmt->execute(array());
  $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
  foreach ($result as $value) {
    $data = $value;
  }
  ?>
  <div class="col-md-12" style="float: center;">
    <div class="row">
      <div class="container">
        <div id="random-name">Generate Randomly</div>
        <button class="btn btn-primary" id="generate" name="generate" value="generate"
          onclick="setRandomName()">Generate</button>
      </div>
    </div>
  </div>
</div>
  </form>
</body>
<script>

  // const fnames =(<?php //echo json_encode($data['FullName']); ?>);
  // const getRandomNumber = (max) => Math.floor(Math.random() * max);
  // const getRandomName = () =>  `${fnames[getRandomNumber(fnames.length)]}`;
  // const setRandomName = () => {
  //   document.getElementById('random-name').innerText = getRandomName();
  // }
  // document.getElementById('generate').addEventListener('click', setRandomName);
  // setRandomName();

  const fnames = (<?php echo json_encode($result); ?>);
  const getRandomName = () => {
    let x = fnames[Math.floor(Math.random() * fnames.length)]
    return fnames.length ? x['FullName'] : 'No value/s to show';
  }

  const setRandomName = () => {
    const initialTable = document.getElementById("myTable");
    initialTable.remove();
    document.getElementById('random-name').classList.add('animate');
    const dist = document.querySelector('#random-name');

  document.querySelector('button').addEventListener('click', () => {
  dist.classList.remove('animate');

  setTimeout(function(){
    dist.classList.add('animate');
  },);
});
    

    let randomName = getRandomName()
    document.getElementById('random-name').innerText = randomName;
    fnames.splice(fnames.findIndex((name) => name.FullName === randomName), 1);
    createClassList();
  }

  const createClassList = () => {
    //Create Table Element
    var element = document.createElement("TABLE");
    element.setAttribute("id", "myTable");
    document.getElementById("myTable").appendChild(element);

    //Create Table Header Element
    var theader = document.createElement("TR");
    theader.setAttribute("id", "header");
    document.getElementById("myTable").appendChild(theader);

    var heads = 'CEAT-37-802A Class List';
    var x = document.createElement("TH");
    x.appendChild(document.createTextNode(heads));
    theader.appendChild(x);

    //Create Table Values (Student Names) Element
    var index;
    var len = fnames.length;

    if (len > 0) {
      for (index = 0, len; index < len; ++index) {
        var y = document.createElement("TR");
        y.setAttribute("id", "myTr");
        document.getElementById("myTable").appendChild(y);

        var t = document.createElement("TD");
        t.appendChild(document.createTextNode(fnames[index]['FullName']));
        y.appendChild(t);
      }
    }
    else {
      //Create Table Header Element
      var theader = document.createElement("TR");
      theader.setAttribute("id", "header");
      document.getElementById("myTable").appendChild(theader);

      var heads = 'No more values to show';
      var x = document.createElement("TD");
      x.appendChild(document.createTextNode(heads));
      theader.appendChild(x);
    }
  }
</script>
</html>