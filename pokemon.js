fetch("https://pokeapi.co/api/v2/pokemon/pikachu")
  .then((res) => res.json())
  .then((data) => {
    console.log(data.name);
    console.log(data.height); // fixed: log, not lo
    console.log(data.weight);
    console.log(data.types);
  });
