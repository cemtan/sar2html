# syntax=docker/dockerfile:1

#ENV http_proxy <YOUR HTTP PROXY>
#ENV https_proxy <YOUR HTTPS PROXY>
#RUN pear config-set http_proxy <YOUR HTTP PROXY>

FROM python:3.9.5-slim-buster

ENV PYTHONDONTWRITEBYTECODE 1
ENV PYTHONUNBUFFERED 1
WORKDIR /sar2html

RUN pip install --upgrade pip

# Packages required for setting up WSGI
RUN apt-get update
RUN apt-get install -y gcc libc-dev python3-dev


COPY requirements.txt requirements.txt
RUN pip3 install -r requirements.txt

COPY . /sar2html

#CMD [ "./startWeb" ]
ENTRYPOINT ["./startWeb"]
