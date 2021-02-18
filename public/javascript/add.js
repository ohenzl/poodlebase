function checkIfExists(source)  {
  let color = 'inherit';
  let stanice = '';
  let name = '';
  // console.log(source.originalTarget)

  if (source.parentElement) {
    name = source.parentElement.children[2];
    stanice = source.parentElement.children[5];

  } else if (source.originalTarget) {
    name = source.originalTarget.parentElement.children[2];
    stanice = source.originalTarget.parentElement.children[5];
  } else {
    console.log('error určení původu')
  }


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
};

let pedigree = document.getElementsByClassName('pedigree');
pedigree.forEach(addListener => {
  addListener.addEventListener('blur', checkIfExists)
})



async function checkExistsSQL(name, stanice) {
  let link = Routing.generate('exists') + '?name=';
  let myPromise = new Promise(function(myResolve, myReject) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        myResolve(this.responseText);
      }
    }
    xmlhttp.open('GET',link+name+"&stanice="+stanice,true);
    xmlhttp.send();
  })
  return state = await myPromise;
}




//nabízení psů
pedigreeCells = document.getElementsByClassName('pedigree')

pedigreeCells.forEach( listenPossibleDogs => {
  // listenPossibleDogs.onkeyup = offerPossibleDogs();
  listenPossibleDogs.addEventListener ( 'keyup', offerDogs => {
    let link = Routing.generate('overviewAPI') + '?';
    let choice = offerDogs.target.parentElement.children[6];

    link += ( offerDogs.target.parentElement.children[2].value ) ? ( 'name_strict=' + offerDogs.target.parentElement.children[2].value + '&' ) : '';
    link += ( offerDogs.target.parentElement.children[5].value ) ? ( 'kennel=' + offerDogs.target.parentElement.children[5].value ) : '';

    retrieveTableFromSQL(link, offerDogs);
  } )
})



function retrieveTableFromSQL(link, parent) {

   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (this.readyState == 4 && this.status == 200) {

       let dogs = JSON.parse(this.responseText);
       let choice = parent.target.parentElement.getElementsByClassName('choice')[0];

       let options = document.getElementsByClassName('option')
       let length = options.length;

       removeChildren(choice, options);

       // for (i = length-1; i >= 0; i--) {
       //   choice.removeChild(options[i])
       // }

       if (link.length > 29) {
         for (const variable in dogs) {
           let td = document.createElement('div');
           td.setAttribute('class', 'option')
           td.setAttribute('data-name', dogs[variable].name)
           td.setAttribute('data-kennel', dogs[variable].kennel)
           td.setAttribute('onclick', 'clickedOptionWrite(this)')
           td.innerHTML = dogs[variable].name + " " + dogs[variable].kennel;
           choice.appendChild(td);
         }
       }
     }
   }
   xmlhttp.open('GET',link,true);
   xmlhttp.send();
}

function removeChildren(parent) {
  let length = parent.children.length;

  for (i = length-1; i >= 0; i--) {
    parent.removeChild(parent.children[i])
  }
}

function clickedOptionWrite(source) {

  source.parentElement.parentElement.children[2].value = source.getAttribute('data-name');
  source.parentElement.parentElement.children[5].value = source.getAttribute('data-kennel');

  checkIfExists(source.parentElement.parentElement.children[2]);

  removeChildren(source.parentElement);

}
