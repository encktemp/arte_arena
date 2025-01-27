"use client";

import React from "react";
import { Container, Box, Typography } from "@mui/material";
import AutocompleteComponent from "../components/AutocompleteComponent";

export default function Home() {
    return (
        <Container
            maxWidth="sm"
            sx={{
                backgroundColor: "#0f0f0f",
                color: "#fff",
                borderRadius: "16px",
                boxShadow: "0px 4px 20px rgba(0, 0, 0, 0.25)",
                border: "0.5px solid #848484", // Adiciona a borda
                p: 4,
                mt: 5,
                textAlign: "center",
            }}
        >
            <Box sx={{ mb: 4 }}>
                <img
                    src="/arte-arena-logo.png"
                    alt="Arte Arena Logo"
                    style={{ width: "100px", marginBottom: "16px" }}
                />
            </Box>
            <Typography variant="h4" sx={{ fontWeight: "bold", mb: 2 }}>
                Posts
            </Typography>
            <AutocompleteComponent />
        </Container>
    );
}
