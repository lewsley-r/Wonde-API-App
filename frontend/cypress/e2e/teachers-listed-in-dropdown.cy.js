describe('Teachers are present in dropdown selection', () => {
    beforeEach(() => {
      // Visits grocery page
      cy.visit('/my-week')
    })
  
    it('displays at least one grocery item by default', () => {
      cy.get('[data-cy="select-teacher-btn"]', { timeout: 10000 }).eq(0).click()
      cy.get('[data-cy="listed-teacher"]').should('have.length.above', 0)
    }) 
  })
  