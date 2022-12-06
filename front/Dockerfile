FROM node:18

WORKDIR /front

COPY * .

RUN npm ci

EXPOSE 3000

CMD ["npm","start"]