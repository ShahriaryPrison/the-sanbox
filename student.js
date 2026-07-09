fetch("student.json")
  .then((response) => response.json())
  .then((data) => {
    let student2 = data["eleventh grade"]["student2"];
    console.log(student2.name);
    console.log(student2.languges);
  });
