function checkExists() {
  console.log(document.getElementsByClassName('pedigree'));
}



let pedigree = document.getElementsByClassName('pedigree');
pedigree.forEach(addListener => {
  addListener.addEventListener('blur', checkIfExists => {
    let color = 'inherit';
    let name = checkIfExists.originalTarget.parentElement.children[2];
    let stanice = checkIfExists.originalTarget.parentElement.children[5];
    console.log(name.value, stanice.value)
    // console.log(stanice.value === '', name.value === '');

    if (stanice.value !== '' || name.value !== '') {
      checkExistsSQL(name.value, stanice.value).then((value) => {
        if (value === 'true') {
          color = 'rgba(76,175,80,0.6)'
        } else {
          color = 'rgba(255,205,210,1)'
        }
        name.style.backgroundColor = color;
        stanice.style.backgroundColor = color;
      })
    } else {
      name.style.backgroundColor = color;
      stanice.style.backgroundColor = color;
    }
  });
})



async function checkExistsSQL(name, stanice) {
  let myPromise = new Promise(function(myResolve, myReject) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        myResolve(this.responseText);
      }
    }
    xmlhttp.open('GET',"/../../exists?name="+name+"&stanice="+stanice,true);
    xmlhttp.send();
  })
  return state = await myPromise;
}
