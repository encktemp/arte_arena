import { Geist, Geist_Mono } from "next/font/google";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata = {
  title: "Teste Arte Arena",
  description: "Teste para Desenvolvedor Full Stack",
};

export default function RootLayout({ children }) {
    return (
        <html lang="pt-br">
            <body
                className="blur-background"
                style={{
                    position: "relative",
                    overflow: "hidden",
                    minHeight: "100vh",
                }}
            >
                <video
                    autoPlay
                    muted
                    loop
                    playsInline
                    style={{
                        position: "fixed",
                        top: 0,
                        left: 0,
                        width: "100%",
                        height: "100%",
                        objectFit: "cover",
                        zIndex: -1,
                    }}
                >
                    <source src="/video-arte-arena-teste.mp4" type="video/mp4" />
                    Seu navegador não suporta a tag de vídeo.
                </video>
                <div className="blur-container">{children}</div>
            </body>
        </html>
    );
}
