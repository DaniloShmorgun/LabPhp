class Student {
  constructor(name, surname, age, course) {
    this.name = name
    this.surname = surname
    this.age = age
    this.course = course
  }

  GetOlder(years)
  {
    return this.age += years;
  }

  MoveToSecondCourse()
  {
    return this.course += 1;
  }
  ChangeSurname(surname)
  {
    return this.surname = surname;
  }

  getInfo()
  {
    console.log(`
      ${this.name} - ім'я
      ${this.surname} - прізвище
      ${this.age} - вік
      ${this.course} - курс
      `)
  }
}

const student = new Student('William', 'Smith', 20, 3)
student.ChangeSurname('NewSurname')
student.GetOlder(2)
student.MoveToSecondCourse()
student.getInfo()
