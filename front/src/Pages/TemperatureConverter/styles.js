import styled from 'styled-components'

export const Container = styled.div`
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    gap: 10px;
    height: 100vh;
    background-color: white;
    min-width: 100vw;

`

export const Label = styled.label`
 
  font-size: 18px;
  font-weight: 600;
  color: #676767;
  
`

export const Form = styled.form`
  gap: 30px 0px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  width: 100%;
  box-shadow: 0 1px 2px #0003;
  background-color: #17181b;
  max-width: 350px;
  padding: 60px;
  border-radius: 15px;
`

export const Input = styled.input`
  outline: none;
  padding: 16px 20px;
  width: 100%;
  border-radius: 5px;
  font-size: 16px;
  background-color: #f0f2f5;
  border: none;
  
`
export const Select = styled.select`
    margin-left: .5rem;
    border:1px solid #333;
    border-radius: .3em;
    padding: .25rem;
    width: 6.5em;
    
`

export const Button = styled.button`
  padding: 16px 20px;
  outline: none;
  border: none;
  border-radius: 5px;
  width: 100%;
  cursor: pointer;
  background-color: #334899;
  color: white;
  font-weight: 600;
  font-size: 16px;
  max-width: 350px;
  
  &:hover {
    background-color: black;
  }
`

export const LabelResult = styled.label`
  font-size: 14px;
  color: red;
`
