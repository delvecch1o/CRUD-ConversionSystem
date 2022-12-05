import React, { useState, useEffect } from "react";
import Header from '../../Components/Header/index'
import { Container, Label, Form, Input, Button, Select, LabelResult } from './styles'
import axios from "axios";

function Coin() {
    const [fromCurrency, setFromCurrency] = useState('brl')
    const [toCurrency, setToCurrency] = useState('usd');
    const [currencyInput, setCurrencyInput] = useState(0);
    const [result, setResult] = useState();

    const handleInput = (e) => {
        e.persist();
        setCurrencyInput(e.target.value)
    }

    const handleSelectFrom = (e) => {
        e.persist();
        setFromCurrency(e.target.value)
    }

    const handleSelectTo = (e) => {
        e.persist();
        setToCurrency(e.target.value)
    }



    const converterMoeda = (e) => {
        e.preventDefault();
        const data = {
            submitIn: currencyInput,
            submitFrom: fromCurrency,
            submitTo: toCurrency,
        }

        axios.post('/api/coin', data)
        .then(res => {
            setResult(res.data.result)
            
        })
        .catch((error) =>{
            alert("Erro, insira moedas válidas")
            
        });

    }


    return (
        <>
            <Header />
            <Container>
                <Label>Conversor de Moedas</Label>
                <Form onSubmit={converterMoeda}>
                    <Input
                        type="number"
                        onChange={handleInput}
                        value={currencyInput}

                    />
                    <Select onChange={handleSelectFrom} value={fromCurrency}>

                        <option value='usd'>USD</option>
                        <option value='eur'>EUR</option>
                        <option value='brl'>BRL</option>

                    </Select>

                    <Select onChange={handleSelectTo} value={toCurrency}>

                        <option value='usd'>USD</option>
                        <option value='eur'>EUR</option>
                        <option value='brl'>BRL</option>

                    </Select>

                    <LabelResult>{result}</LabelResult>

                    <Button type="submit">Converter</Button>

                </Form>
            </Container>
        </>
    )
}

export default Coin