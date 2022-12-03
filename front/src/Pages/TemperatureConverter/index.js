import React, { useState, useEffect } from "react";
import Header from "../../Components/Header";
import { Container, Label, Form, Input, Button, Select, LabelResult } from './styles'
import axios from "axios";



function Temperature() {

    const [temperatureInput, setTemperatureInput] = useState(0)
    const [fromTemperature, setFromTemperature] = useState('celsius');
    const [toTemperature, setToTemperature] = useState('fahrenheit');
    const [result, setResult] = useState();

    const handleTemperatureInput= (e) => {
        e.persist();
        setTemperatureInput(e.target.value)
    }

    const handleSelectFromTemperature = (e) => {
        e.persist();
        setFromTemperature(e.target.value)
    }

    const handleSelectToTemperature = (e) => {
        e.persist();
        setToTemperature(e.target.value)
    }



    const converterTemperatura = (e) => {
        e.preventDefault()
        const data = {
            submitIn: temperatureInput,
            submitFrom: fromTemperature,
            submitTo: toTemperature,
        }

        axios.post('/api/temperature', data).then(res => {

            setResult(res.data.result)

            console.log(res.data)
            if (res.data.status === 200) {

            } else if (res.data.status === 400) {

                setTemperatureInput({ ...temperatureInput, error_list: res.data.errors });

            }

        });
    }

    return (
        <>
            <Header />
            <Container>
                <Label>Conversor de Temperatura</Label>
                <Form onSubmit={converterTemperatura}>
                    <Input
                        type="number"
                        onChange={handleTemperatureInput}
                        value={temperatureInput}

                    />
                    <Select onChange={handleSelectFromTemperature} value={fromTemperature}>

                        <option value='celsius'>Celsius</option>
                        <option value='fahrenheit'>Fahrenheit</option>
                        <option value='kelvin'>Kelvin</option>

                    </Select>

                    <Select onChange={handleSelectToTemperature} value={toTemperature}>

                        <option value='celsius'>Celsius</option>
                        <option value='fahrenheit'>Fahrenheit</option>
                        <option value='kelvin'>Kelvin</option>

                    </Select>

                    <LabelResult>{result}</LabelResult>

                    <Button type="submit">Converter</Button>

                </Form>
            </Container>
        </>

    )
}

export default Temperature