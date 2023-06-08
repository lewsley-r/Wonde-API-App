describe('This teacher selected has their schedule populated on screen', () => {
    beforeEach(() => {
      // Visits grocery page
      cy.visit('/my-week')
    })
  
    it('Schedule appear', () => {
      let teacher1;
      cy.get('[data-cy="select-teacher-btn"]', { timeout: 10000 }).eq(0).click()
      cy.get('[data-cy="listed-teacher"]').eq(0).then(($listedTeacher) => {
        teacher1 = $listedTeacher.text()
      })
      cy.get('[data-cy="listed-teacher"]').eq(0).click()

      cy.get('[data-cy="select-teacher-card-name"]', { timeout: 2000 }).then(($Teacher) => {
        const teacher2 = $Teacher.text()
        expect(teacher1).eq(teacher2)
      })
     


      
    }) 
  })
  