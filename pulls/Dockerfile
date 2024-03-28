FROM amazoncorretto:22.0.0-alpine3.19

VOLUME /tmp
COPY target/*.jar /app/app.jar
CMD ["java","jar","/app/app.jar"]
ENTRYPOINT ["java","-jar","/app/app.jar"]