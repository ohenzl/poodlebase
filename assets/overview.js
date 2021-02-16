
import './styles/overview.scss';


class Dog {

  createUnderlyingInformation() {
    this.titles = ['Chovná stanice', 'Barva', 'Pohlaví', 'Narození', 'Otec', 'Matka', 'Chovatel', 'Majitel'];
    this.source = [this.kennel, this.color, this.sex, this.birth, this.father_name + " " + this.father_kennel, this.mother_name + " " + this.mother_kennel, this.breeder, this.owner];
  }

  createNodes() {
    this.createUnderlyingInformation();
    let tr = document.createElement('tr');
    let td = [];

    //vytvoření jména s odkazem
    td[0] = document.createElement('td');
    td[0].innerHTML =  "<a href =" + Routing.generate('displayDogWithDog', {dogID: this.ID, dogname: (this.name + " " + this.kennel).replace(" ", "-")}) + ">" + this.name + "</a>"
    tr.appendChild(td[0]);

    for (let i = 0; i < this.titles.length; i++) {
      // console.log(this.titles[i], this.source[i])
      td[i] = document.createElement('td');

      if (this.source[i] !== undefined && this.source[i] !== 'null null') {
        if (this.titles[i] !== 'Narození') {
          td[i].innerHTML = this.source[i];
        } else {
          let date = new Date(this.source[i]);
          td[i].innerHTML = ("0" + date.getDate()).slice(-2) + "." + ("0"+(date.getMonth()+1)).slice(-2) + "." + date.getFullYear();
        }
      }
      if (this.source[i] === '0000-00-00') {
        td[i].innerHTML = 'neudáno';
      }
      td[i].setAttribute('data-title', this.titles[i]);
      tr.appendChild(td[i]);
    }

    // console.log(tr)
    return tr;
  }

}


// filter logic
//open/close

document.getElementById('filtrButton').addEventListener('click', openClose => {
  let filtr = document.getElementById('filtr');
  if (openClose.target.getAttribute('data-open') === '+') {
    openClose.target.setAttribute('data-open', '-')
    filtr.style.maxHeight = '200px';
  } else {
    openClose.target.setAttribute('data-open', '+')
    filtr.style.maxHeight = '0px';
  }
  console.log(filtr.getAttribute('data-open'))
})



//create link for API
let filterInputs = document.getElementsByClassName('filterInput');

for (let i = 0; i < filterInputs.length; i++) {
  filterInputs[i].addEventListener('keyup', registerKey => {
    filterOutput();
  })
}

function filterOutput() {
  let link = '?';
  for (let i = 0; i < filterInputs.length; i++) {
    if (filterInputs[i].value.length > 2) {
      link += `${filterInputs[i].id}=${filterInputs[i].value}&`
    }
  }
  // if (link === '?') return;
  retrieveTableFromSQL(link);
}


//create SQL query based on the function above

 function retrieveTableFromSQL(link) {
   // console.log(link)
   let url = Routing.generate('overviewAPI');
   // console.log(url)

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let body = document.getElementById('tableBody');
        let dogs = JSON.parse(this.responseText);
        let nodes = [];

        let newbody = createBody(body.parentElement);
        body.parentNode.removeChild(body);

        for (const variable in dogs) {
          nodes[variable] = new Dog;
          Object.assign(nodes[variable], dogs[variable]);
          // console.log(nodes)
        }

        nodes.sort((a, b) => (a.name > b.name) ? 1 : -1)

        nodes.forEach(createNodes => {
          newbody.appendChild(createNodes.createNodes());
        });
      }
    }
    xmlhttp.open('GET',url+link,true);
    xmlhttp.send();
}


function createBody(table) {
  let body = document.createElement("tbody");
  body.id = 'tableBody'
  table.appendChild(body)
  return body;
}


filterOutput();
